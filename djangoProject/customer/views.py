from django.contrib.auth import authenticate, login, logout
from django.contrib.auth.decorators import login_required
from django.db import IntegrityError
from django.views.decorators.csrf import csrf_exempt
from django.urls import reverse
from django.shortcuts import HttpResponseRedirect, render
from .models import User
from datetime import datetime
from django.contrib import messages


def index(request):

    return render(request, "customer/index.html")


def donation(request):
    return render(request, "customer/donation.html")


def orders(request):
    if request.user.is_authenticated:
        return render(request, "customer/orders.html")

    else:
        return HttpResponseRedirect(reverse("login_view"))


# change to each restaurant one page later
def ordering(request):
    return render(request, "customer/ordering.html")


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
        userType = request.POST['user-types']

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
            user.userType = userType
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
