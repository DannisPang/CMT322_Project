from django.db import models
from django.contrib.auth.models import AbstractUser


class User(AbstractUser):
    contactnum = models.CharField(db_column='ContactNum', max_length=11)  # Field name made lowercase.
    address = models.CharField(db_column='Address', max_length=50)  # Field name made lowercase.
    ewallet = models.DecimalField(db_column='EWallet', max_digits=10, decimal_places=2, default=0)  # Field name made lowercase.
    usertype = models.CharField(db_column='UserType', max_length=7)  # Field name made lowercase.
    amountdonated = models.DecimalField(db_column='AmountDonated', max_digits=10, decimal_places=2, default=0)  # Field name made lowercase.

    class Meta:
        managed = False
        db_table = 'auth_user'


class Restaurant(models.Model):
    restaurantid = models.CharField(db_column='RestaurantID', primary_key=True, max_length=5)
    ownerid = models.ForeignKey(User, db_column='OwnerID', related_name="restaurant", on_delete=models.CASCADE, limit_choices_to={'usertype': 'V'})
    restaurantname = models.CharField(db_column='RestaurantName', max_length=25)
    description = models.CharField(db_column='Description', max_length=150)
    contactnum = models.CharField(db_column='ContactNum', max_length=11)
    address = models.CharField(db_column='Address', max_length=255)
    image = models.ImageField(db_column='Image', upload_to="images/restaurants/%Y/%m/%D/")

    class Meta:
        # managed = False
        db_table = 'restaurant'


class Product(models.Model):
    productid = models.CharField(db_column='ProductID', primary_key=True, max_length=5)
    restaurantid = models.ForeignKey(Restaurant, db_column='RestaurantID', on_delete=models.CASCADE)
    productname = models.CharField(db_column='ProductName', max_length=20)
    productprice = models.DecimalField(db_column='ProductPrice', max_digits=10, decimal_places=2)
    productpic = models.ImageField(db_column='ProductPic', upload_to="images/products/%Y/%m/%D/")

    class Meta:
        # managed = False
        db_table = 'product'


class Orderitem(models.Model):
    orderid = models.CharField(db_column='OrderID', primary_key=True, max_length=5)
    restaurantid = models.ForeignKey(Restaurant, db_column='RestaurantID', on_delete=models.CASCADE)
    userid = models.ForeignKey(User, db_column='UserID', related_name="order", on_delete=models.CASCADE, limit_choices_to={'usertype': 'C'})
    addresstodelivery = models.CharField(db_column='AddressToDelivery', max_length=50)
    deliveryfee = models.DecimalField(db_column='DeliveryFee', max_digits=2, decimal_places=0)
    status = models.CharField(db_column='Status', max_length=10)  #
    reasonofreject = models.CharField(db_column='ReasonOfReject', max_length=20)
    riderid = models.ForeignKey(User, db_column='RiderID', related_name="delivery", on_delete=models.PROTECT, limit_choices_to={'usertype': 'R'})

    class Meta:
        # managed = False
        db_table = 'orderitem'


class Orderproduct(models.Model):
    orderid = models.ForeignKey(Orderitem, db_column='OrderID', on_delete=models.CASCADE)
    productid = models.ForeignKey(Product, db_column='ProductID', on_delete=models.CASCADE)
    amount = models.DecimalField(db_column='Amount', max_digits=10, decimal_places=2)

    class Meta:
        unique_together = ("orderid", "productid")
        # managed = False
        db_table = 'orderproduct'


class Review(models.Model):
    reviewid = models.CharField(db_column='ReviewID', primary_key=True, max_length=5)
    productid = models.ForeignKey(Product, db_column='ProductID', on_delete=models.CASCADE)
    rating = models.IntegerField(db_column='Rating')
    comment = models.CharField(db_column='Comment', max_length=25)
    userid = models.ForeignKey(User, db_column='UserID', on_delete=models.PROTECT, limit_choices_to={'usertype': 'C'})

    class Meta:
        # managed = False
        db_table = 'review'
