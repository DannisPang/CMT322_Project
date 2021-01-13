from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.decorators import login_required
from django.db import IntegrityError
from django.views.decorators.csrf import csrf_exempt
from django.urls import reverse
from django.shortcuts import HttpResponseRedirect, render, HttpResponse
from django.http import HttpResponseNotAllowed
from .models import User, Restaurant, Product, Review
from datetime import datetime
from django.contrib import messages
from decimal import Decimal


def index(request):
    restaurants = Restaurant.objects.all()
    return render(request, "customer/index.html", {
        "restaurants": restaurants
    })


@csrf_exempt
def login_view(request):
    if request.method == "POST":

        # Attempt to sign user in
        username = request.POST["username"]
        password = request.POST["password"]
        user = authenticate(request, username=username, password=password)

        # Check if authentication is successful
        if user is not None:
            login(request, user)
            initialize_session(request)
            return HttpResponseRedirect(reverse('index'))
        else:
            messages.error(request, "Invalid username or password.", "alert alert-danger")
            return render(request, "customer/login.html")
    else:
        return render(request, "customer/login.html")


def logout_view(request):
    logout(request)
    return HttpResponseRedirect(reverse("index"))


@csrf_exempt
def register_view(request):
    if request.method == "POST":
        email = request.POST['username']
        first_name = request.POST['fname']
        last_name = request.POST['lname']
        user_type = request.POST['user-types']
        contact_num = request.POST['contact']
        address = request.POST['address']

        # Ensure password match confirmation
        password = request.POST["password"]
        confirmation = request.POST["confirmation"]
        if password != confirmation:
            messages.error(request, "Passwords must match.", "alert alert-danger")
            return render(request, "customer/register.html")

        # Create new user
        try:
            user = User.objects.create_user(email, email, password)
            user.last_login = datetime.now()
            user.is_superuser = False
            user.first_name = first_name
            user.last_name = last_name
            user.is_staff = False
            user.is_active = True
            user.date_joined = datetime.now()
            user.contactnum = contact_num
            user.address = address
            user.usertype = user_type
            user.save()
        except IntegrityError as e:
            print(e)
            messages.error(request, "Email address already taken.", "alert alert-danger")
            return render(request, "customer/register.html")
        login(request, user)
        initialize_session(request)
        return HttpResponseRedirect(reverse("index"))
    else:
        return render(request, "customer/register.html")


def donation(request):
    return render(request, "customer/donation.html")


def make_donation(request):
    if request.user.is_authenticated:
        if request.method == "POST":
            amount_donate = Decimal(request.POST['select'])
            if amount_donate == 0.00:
                amount_donate = Decimal(request.POST['amount'])
            ewallet = request.user.ewallet
            if ewallet < amount_donate:
                messages.error(request, "Not enough E-Wallet balance. Please top up.", "alert alert-danger")
            else:
                request.user.ewallet = ewallet - amount_donate
                request.user.amountdonated += amount_donate
                request.user.save()

                # add to admin's account
                admin = User.objects.filter(email='admin@gmail.com').first()
                admin.ewallet += amount_donate
                admin.save()

                messages.success(request, "Thank you for your donation!", "alert alert-success")

        return render(request, "customer/donation.html")
    else:
        return HttpResponseRedirect(reverse("login_view"))


def orders(request):
    if request.user.is_authenticated:
        return render(request, "customer/orders.html")

    else:
        return HttpResponseRedirect(reverse("login_view"))


def ordering(request, restaurant_id):
    products = Product.objects.filter(restaurantid=restaurant_id)
    restaurant = Restaurant.objects.filter(restaurantid=restaurant_id).first()

    if len(products) == 0:
        messages.error(request, "Product not found.", "alert alert-danger")
        reviews = []

    else:
        product_list = []
        for product in products:
            product_list.append(product.productid)

        reviews = Review.objects.filter(productid__in=product_list)

    return render(request, "customer/ordering.html", {
        "products": products,
        "restaurant": restaurant,
        "reviews": reviews
    })


@login_required
def confirm_order(request):
    return render(request, "customer/confirm-order.html")


@login_required
def write_review(request):
    if request.method == "POST":
        restaurantid = request.POST['restaurantid']
        rating = request.POST['rating']
        comment = request.POST['comment']
        productid = request.POST['products']

        new_review = Review.objects.create(
            reviewid=increment_id(Review, "reviewid", "RE"),
            productid=Product.objects.filter(productid=productid).first(),
            rating=rating,
            comment=comment,
            userid=User.objects.filter(id=request.user.id).first()
        )
        new_review.save()
        messages.success(request, "Thank you for your review!", "alert alert-success")
    return HttpResponse('ok')


def initialize_session(request):

    request.session['cart'] = {
        "restaurantid": '',
        "subtotal": 0.00,
        "deliveryfee": 0.00,
        "total": 0.00,
        "products": []
    }
    request.session.set_expiry(1209600)


@csrf_exempt
def add_item_to_cart(request, restaurant_id, product_id):
    if not request.is_ajax() or not request.method == "POST":
        return HttpResponseNotAllowed(['POST'])

    cart = request.session.get('cart')

    if cart.get('restaurantid') != restaurant_id and cart.get('restaurantid') != "":
        return HttpResponse('Cannot add item from different vendors.')
    else:
        cart['restaurantid'] = restaurant_id
        found = False
        for i, product in enumerate(cart.get('products')):
            if product.get("productid") == product_id:
                # product already exist, quantity + 1
                cart.get('products')[i]['qty'] += 1
                found = True
                break

        if not found:
            # product not exist, add to cart
            product = Product.objects.filter(productid=product_id).first()

            new_product = {
              "productid": product_id,
              "productname": product.productname,
              "productprice": str(product.productprice),
              "qty": 1
            }
            cart.get('products').append(new_product)

        request.session.save()
        request.session.modified = True

        if len(cart.get('products')) == 1:
            cart['deliveryfee'] = 3.00

        update_cart_price(request)

        return HttpResponse('ok')


@csrf_exempt
def update_cart_quantity(request, product_id, qty):
    if not request.is_ajax() or not request.method == "POST":
        return HttpResponseNotAllowed(['POST'])

    cart = request.session.get('cart')

    for i, product in enumerate(cart.get('products')):
        if product.get("productid") == product_id:
            cart.get('products')[i]['qty'] = qty
            request.session.save()
            request.session.modified = True

    update_cart_price(request)
    return HttpResponse('ok')


@csrf_exempt
def remove_item_from_cart(request, product_id):
    if not request.is_ajax() or not request.method == "POST":
        return HttpResponseNotAllowed(['POST'])

    cart = request.session.get('cart')

    for i, product in enumerate(cart.get('products')):
        if product.get("productid") == product_id:
            del cart.get('products')[i]
            request.session.save()
            request.session.modified = True

    if len(cart.get('products')) == 0:
        initialize_session(request)
    else:
        update_cart_price(request)

    return HttpResponse('ok')


def update_cart_price(request):

    cart = request.session.get('cart')
    cart_products = cart.get('products')

    subtotal = 0
    for product in cart_products:
        print(product)
        subtotal += Decimal(product.get('productprice')) * Decimal(product.get('qty'))

    cart['subtotal'] = str(subtotal)
    cart['deliveryfee'] = 3
    cart['total'] = str(subtotal + 3)
    request.session.save()
    request.session.modified = True


# generate new primary key
def increment_id(obj, idname, letter):
    last_data = obj.objects.all().order_by(idname).last()
    if not last_data:
        return letter + '001'

    last_id = getattr(last_data, idname)
    id_int = int(''.join(filter(lambda i: i.isdigit(), last_id)))  # extract digits only and convert to int
    new_id_int = id_int + 1
    new_id = letter + str(new_id_int).zfill(3)

    return new_id

