# Generated by Django 2.2.7 on 2021-01-14 03:16

from django.conf import settings
from django.db import migrations, models
import django.db.models.deletion


class Migration(migrations.Migration):

    dependencies = [
        ('customer', '0001_initial'),
    ]

    operations = [
        migrations.AlterField(
            model_name='orderitem',
            name='reasonofreject',
            field=models.CharField(blank=True, db_column='ReasonOfReject', max_length=20),
        ),
        migrations.AlterField(
            model_name='orderitem',
            name='riderid',
            field=models.ForeignKey(blank=True, db_column='RiderID', limit_choices_to={'usertype': 'R'}, on_delete=django.db.models.deletion.PROTECT, related_name='delivery', to=settings.AUTH_USER_MODEL),
        ),
    ]