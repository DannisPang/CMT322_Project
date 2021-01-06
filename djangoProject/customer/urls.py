from django.urls import path
from . import views

urlpatterns = [
    path('', views.index, name='index'),
    path('donation', views.donation, name='donation'),
    path('orders', views.orders, name='orders'),
    path('ordering', views.ordering, name='ordering'),
    path('login', views.login, name='login'),
    path('register', views.register, name='register'),
    path('confirm-order', views.confirm_order, name='confirm_order'),
]
