# This is an auto-generated Django model module.
# You'll have to do the following manually to clean this up:
#   * Rearrange models' order
#   * Make sure each model has one field with primary_key=True
#   * Make sure each ForeignKey has `on_delete` set to the desired behavior.
#   * Remove `managed = False` lines if you wish to allow Django to create, modify, and delete the table
# Feel free to rename the models, but don't rename db_table values or field names.
from django.db import models
from django.contrib.auth.models import AbstractUser


class User(AbstractUser):
    contactnum = models.CharField(db_column='ContactNum', max_length=11)  # Field name made lowercase.
    address = models.CharField(db_column='Address', max_length=50)  # Field name made lowercase.
    ewallet = models.DecimalField(db_column='EWallet', max_digits=10, decimal_places=0, default=0)  # Field name made lowercase.
    usertype = models.CharField(db_column='UserType', max_length=7)  # Field name made lowercase.
    amountdonated = models.DecimalField(db_column='AmountDonated', max_digits=10, decimal_places=0, default=0)  # Field name made lowercase.


    class Meta:
        managed = False
        db_table = 'auth_user'


class Orderitem(models.Model):
    orderid = models.CharField(db_column='OrderID', primary_key=True, max_length=5)  # Field name made lowercase.
    restaurantid = models.CharField(db_column='RestaurantID', max_length=5)  # Field name made lowercase.
    userid = models.CharField(db_column='UserID', max_length=5)  # Field name made lowercase.
    addresstodelivery = models.CharField(db_column='AddressToDelivery', max_length=50)  # Field name made lowercase.
    deliveryfee = models.DecimalField(db_column='DeliveryFee', max_digits=2, decimal_places=0)  # Field name made lowercase.
    status = models.CharField(db_column='Status', max_length=10)  # Field name made lowercase.
    reasonofreject = models.CharField(db_column='ReasonOfReject', max_length=20)  # Field name made lowercase.
    riderid = models.CharField(db_column='RiderID', max_length=5)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'orderitem'


class Orderproduct(models.Model):
    orderid = models.CharField(db_column='OrderID', primary_key=True, max_length=5)  # Field name made lowercase.
    productid = models.CharField(db_column='ProductID', max_length=5)  # Field name made lowercase.
    amount = models.DecimalField(db_column='Amount', max_digits=2, decimal_places=0)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'orderproduct'


class Product(models.Model):
    productid = models.CharField(db_column='ProductID', primary_key=True, max_length=5)  # Field name made lowercase.
    restaurantid = models.CharField(db_column='RestaurantID', max_length=5)  # Field name made lowercase.
    productname = models.CharField(db_column='ProductName', max_length=20)  # Field name made lowercase.
    productprice = models.DecimalField(db_column='ProductPrice', max_digits=2, decimal_places=0)  # Field name made lowercase.
    productpic = models.CharField(db_column='ProductPic', max_length=10)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'product'


class Restaurant(models.Model):
    restaurantid = models.CharField(db_column='RestaurantID', primary_key=True, max_length=5)  # Field name made lowercase.
    restaurantname = models.CharField(db_column='RestaurantName', max_length=25)  # Field name made lowercase.
    description = models.CharField(db_column='Description', max_length=150)  # Field name made lowercase.
    contactnum = models.CharField(db_column='ContactNum', max_length=11)  # Field name made lowercase.
    address = models.CharField(db_column='Address', max_length=50)  # Field name made lowercase.
    image = models.CharField(db_column='Image', max_length=10)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'restaurant'


class Review(models.Model):
    reviewid = models.CharField(db_column='ReviewID', primary_key=True, max_length=5)  # Field name made lowercase.
    productid = models.CharField(db_column='ProductID', max_length=5)  # Field name made lowercase.
    rating = models.IntegerField(db_column='Rating')  # Field name made lowercase.
    comment = models.CharField(db_column='Comment', max_length=25)  # Field name made lowercase.
    username = models.CharField(db_column='UserName', max_length=25)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'review'
