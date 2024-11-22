from django.urls import path
from .views import predict  # Ensure this is the correct path to your view

urlpatterns = [
    path('predict/', predict, name='predict'),
]
