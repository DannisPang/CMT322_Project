from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.decorators import login_required
from django.db import IntegrityError
from django.views.decorators.csrf import csrf_exempt
from django.urls import reverse
from django.shortcuts import HttpResponseRedirect, render
from .models import User, Restaurant, Product
from datetime import datetime
from django.contrib import messages


def index(request):
    restaurants = Restaurant.objects.all()
    return render(request, "customer/index.html", {
        "restaurants": restaurants
    })


def donation(request):
    return render(request, "customer/donation.html")


def orders(request):
    if request.user.is_authenticated:
        return render(request, "customer/orders.html")

    else:
        return HttpResponseRedirect(reverse("login_view"))


def ordering(request, restaurant_id):
    products = Product.objects.filter(restaurantid=restaurant_id)
    restaurant = Restaurant.objects.filter(restaurantid=restaurant_id)
    if len(products) == 0:
        messages.error(request, "Product not found.", "alert alert-danger")
    return render(request, "customer/ordering.html", {
        "products": products,
        "restaurant": restaurant[0]
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
        return HttpResponseRedirect(reverse("index"))
    else:
        return render(request, "customer/register.html")


@login_required()
def confirm_order(request):
    return render(request, "customer/confirm-order.html")
