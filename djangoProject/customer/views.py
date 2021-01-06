from django.shortcuts import HttpResponse, render


def index(request):
    return render(request, "customer/index.html")


def donation(request):
    return render(request, "customer/donation.html")


def orders(request):
    return render(request, "customer/orders.html")


# change to each restaurant one page later
def ordering(request):
    return render(request, "customer/ordering.html")


def login(request):
    return render(request, "customer/login.html")


def register(request):
    return render(request, "customer/register.html")


def confirm_order(request):
    return render(request, "customer/confirm-order.html")

