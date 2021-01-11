from django.contrib import admin
from django.contrib.auth.admin import UserAdmin
from .models import User, Restaurant, Product

# Register your models here.

admin.site.register(User, UserAdmin)
admin.site.register(Restaurant)
admin.site.register(Product)
