from django.urls import path
from . import views

urlpatterns = [
    path('', views.index, name='index'),
    path('donation', views.donation, name='donation'),
    path('orders', views.orders, name='orders'),
    path('ordering', views.ordering, name='ordering'),
    path('login', views.login_view, name='login_view'),
    path('register', views.register_view, name='register_view'),
    path('confirm-order', views.confirm_order, name='confirm_order'),
    path('logout', views.logout_view, name="logout_view")
]
