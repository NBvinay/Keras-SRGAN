from django.shortcuts import render
from django.http import HttpResponse
from django.shortcuts import redirect

# Create your views here.
# import requests
from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework.utils import json


import subprocess



class RunSuperRes(APIView):
    def get(self, request):      
        response_data = "hello world"
        subprocess.call(['F:\wamp\www\superres\\function\start.bat'])
        response = redirect('http://localhost/superres/function/before-after-comparison-slider-master/')
        return response
