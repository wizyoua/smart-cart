
<!DOCTYPE html>
<html>
<head>
	<title>Final Cart</title>


	<!-- LOAD JQUERY -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

	<!-- LOAD ANGULAR -->
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>

  <!-- LOAD Libraries -->
	<script type="text/javascript" src="ngCart.js"></script>
  <script type="text/javascript" src="js/dropdownLayer.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

  <!-- LOAD BOOTSTRAP CSS -->
  <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="css/style.css">

	<script type="text/javascript">
		
		//Initiate the Angular Module
		var app = angular.module('order', ['ngCart']);

		//Controller for Implementing data into Cart
		app.controller('ShopCartCtrl', ['$scope', 'ngCart', '$http', function ($scope, ngCart, $http) {
			// Calls url to get json data
		   $http.get("use.json")
		   // If data received successfully, begin to change DOM
		   .then(function (response) {

		   	// First level of JSON DATA, assign the general categories to variables
		   	$scope.preMade = response.data.premadeSandwhich;

         // Grab data when user is ready to checkout
          $scope.showAction = function (id){
            //Check if user selected more than 1 meat, run a for loop until we reach ingredients -> and seperate by meat only since that is what will be charged. 
              var preData = ngCart['$cart']['items'];
              
              // Grab data after user presses order
              var postData = JSON.stringify(ngCart['$cart']['items']); 
              console.log(postData);
              $scope.postData = postData;
              // for (var j = 0; j < preData.length; j++){
              //   console.log(preData[j]);
              // }
              //if yes, add price of single meat td data
              


                             
              // Make Data usable with php form
              //this.postData = postData;
              //console.log(this.postData);
              //data testing -rm
              }


		   	// Grab data when user is ready to checkout
	        $scope.updateFinalOrder= function (postData){
	          // Grab data after user presses order
	          //location.reload();
	        }
        
	        $scope.showAction = function (id){
                //Check if user selected more than 1 meat, run a for loop until we reach ingredients -> and seperate by meat only since that is what will be charged. 
                  var preData = ngCart['$cart']['items'];
                  //console.log(preData);

                  //Begin to loop items in cart to check for multiples
                  for (var j = 0; j < preData.length; j++){
                    
                    //remove console
                    var initialLayer = preData[j];
                    //console.log(initialLayer);
                    
                    //remove console
                    var dataLayer = preData[j]._data;
                    //console.log(dataLayer);

                    //begin for looping through data array in cart
                    for (var k = 0; k < dataLayer.length; k++){
                      
                      //general variable - add category in which you want to loop
                      var meatLayer = dataLayer[k];

                      //begin accessing individual meats
                      if(meatLayer.Meats){
                        var indMeat = meatLayer.Meats.Type;
                        //console.log(meatLayer.Meats.Type);

                        for(var l = 0; l < indMeat.length; l++){
                          var indMeatTrue = indMeat[l].Double;
                          console.log(indMeatTrue);



                        }
                        
                      }

                     
                      
                    }
                  

                  }
                      //if yes, add price of single meat td data
                  


    	          	// Grab data after user presses order
    	          	var postData = JSON.stringify(ngCart['$cart']['items']);
                  
                  
    	          	// Make Data usable with php form
    	          	$scope.postData = postData;
    	          	//data testing -rm
    	          	//console.log($scope.postData);
    			}
		   });

      //make only 1 checkbox selectale for Bread Section
      $scope.updateSelection = function(position, entities) {
        console.log(entities);
        angular.forEach(entities, function(subscription, index) {
          console.log(index);
          if (position != index) 
            subscription.Present = false;
        });
      }

   

			ngCart.setTaxRate(7.5);
			ngCart.setShipping(0.00);
		}]);
	</script>

</head>


<body ng-app="order">

<div ng-controller="ShopCartCtrl">
  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: #fff;">
      <div class="container">
          <div class="navbar-header">
              <p style="margin-bottom: 0px; font-size: 16px; font-weight: bold;">Pick up Store: </p>
              <span style="color: #8c8c48;">Store</span>
          </div>
          
          <div class=" navbar-header pull-right">
                  <p style="margin-bottom: 0px; font-size: 16px; font-weight: bold;">Cart Total: <span><ngcart-summary></ngcart-summary></span></p>
                  <button class="btn btn navbar-btn" style="background-color: #8c8c48; color: #fff; border-radius: 0px; margin-top: 0px;" data-toggle="modal" data-target="#modaltest" ng-click="updateFinalOrder(postData)">CHECKOUT ></button>
                  <!-- Script for Displaying total order summary -->
                  <script type="text/ng-template" id="template/ngCart/summary.html">
                    <span class="">{{ ngCart.getTotalItems() }}
                      <ng-pluralize count="ngCart.getTotalItems()" when="{1: 'item', 'other':'items'}"></ng-pluralize>
                      {{ ngCart.totalCost() | currency }}
                    </span>
                  </script>
          </div>
      </div>
  </nav>


<!-- Intro to Page -->
<div style="width:100%; text-align: center;">
    <img src="images/logo.png" style="text-align: center; width: 200px; ">    
    <div style="width: 100%; height: 28px; border-bottom: 1px solid #9F834D; text-align: center; color:#9F834D; margin-bottom: 30px; ">
      <span style="font-size: 40px; background-color: #e9e0c7; padding: 0 10px;">
        Order For Pickup <!--Padding? is optional-->
      </span>
    </div>
</div>




<div class="container">
  <div class="row">
<!-- Get the Sandwhich information right-->
<h2>Choose our Premade Sandwhiches</h2>
  <div class="row text-center">


    <div class="col-lg-4 col-md-4 col-xs-6 " ng-repeat="customWhich in preMade">
      <img src="https://placehold.it/262x150" alt="image" />
      <h4>{{customWhich.Name}}</h4>
      <p>{{customWhich.Price}}</p>
      <div>
      	<div class="col-md-6">
      		<span ng-repeat="customWhichCategory in customWhich.Ingredients">

			<ul ng-repeat="customWhichCategoryFinal in customWhichCategory.Bread">
				Pick 1 Bread:
				<li ng-repeat="customWhichBread in customWhichCategoryFinal">
					{{customWhichBread.Name}}
					{{customWhichBread.Present}} 
          			<input ng-
                model="customWhichBread.Present" ng-click="updateSelection($index, customWhichCategoryFinal)" type="checkbox" />
				</li>

			</ul>
			<ul ng-repeat="customWhichCategoryFinal in customWhichCategory.Meats">
				Pick a Meat Pick 1:
				<li ng-repeat="customWhichMeat in customWhichCategoryFinal">
					{{customWhichMeat.Name}}
					{{customWhichMeat.Present}}
					<input type="checkbox" name="" ng-model="customWhichMeat.Present" ng-change="stateChanged()" ng-clicked="">

         			<!-- Double: 
          			{{customWhichMeat.Double }} -->
          			<!-- <input type="checkbox" name="" ng-model="customWhichMeat.Double"> -->
				</li>
			</ul>
			<ul ng-repeat="customWhichCategoryFinal in customWhichCategory.Veggies ">
				Pick some Veggies Pick 4:
				<li ng-repeat="customWhichVeggies in customWhichCategoryFinal">
					{{customWhichVeggies.Name}}
					{{customWhichVeggies.Present}}
					<input type="checkbox" name="" ng-model="customWhichVeggies.Present" class="single-checkbox"><br>
				</li>
			</ul>
			<ul ng-repeat="customWhichCategoryFinal in customWhichCategory.Condiments">
				Pick some Condiments: Pick 3
				<li ng-repeat="customWhichCond in customWhichCategoryFinal ">
					{{customWhichCond.Name}}
					{{customWhichCond.Present}}
					<input type="checkbox" name="" ng-model="customWhichCond.Present"><br>
				</li>
			</ul>
		</span>	
		<ngcart-addtocart id="{{customWhich.+$index+1}}" name="{{customWhich.Name}}"  data="customWhich.Ingredients" price="{{customWhich.Price}}" quantity="1" quantity-max="5" ng-click="showAction(customWhich.+$index+1)">Add to Cart</ngcart-addtocart>
      	</div>
      	<!-- Show Sand which Build -->
      	<div class="col-md-6">
      		<h3>Your Sandwhich Details</h3>
      		<div  ng-repeat="customWhichCategory in customWhich.Ingredients" >
      		<hr>
      			<span ng-repeat="customWhichCategoryFinal in customWhichCategory.Bread">
      				Bread: 
      				<p ng-repeat="customWhichSingle in customWhichCategoryFinal | filter: {'Present': true}: true">
      				{{customWhichSingle.Name}} 
      				</p>
      			</span>
      		
      			<span ng-repeat="customWhichCategoryFinal in customWhichCategory.Meats">
      				Meats:
      				<p ng-repeat="customWhichSingle in customWhichCategoryFinal | filter: {'Present': true}: true">
      				   {{customWhichSingle.Name}}<span ng-repeat="customWhichSingle in customWhichCategoryFinal | filter: {'Double': true}: true "> + Double</span>
              		</p>
      			</span>
      			<span ng-repeat="customWhichCategoryFinal in customWhichCategory.Veggies">
      				Veggies: 
      				<p ng-repeat="customWhichSingle in customWhichCategoryFinal | filter: {'Present': true}: true">
      				{{customWhichSingle.Name}}</p>
      			</span>
      			<span ng-repeat="customWhichCategoryFinal in customWhichCategory.Condiments">
      				Condiments:
      				<p ng-repeat="customWhichSingle in customWhichCategoryFinal | filter: {'Present': true}: true">
      				{{customWhichSingle.Name}}</p>
      			</span>


      		</div>
      	</div>
      </div>
    </div>
  </div>
  </div>
</div>



<!-- SCript for Displaying total order summary -->
<script type="text/ng-template" id="template/ngCart/cart.html">
<div class="alert alert-warning" role="alert" ng-show="ngCart.getTotalItems() === 0">
  Your cart is empty
</div>
<div class="table-responsive col-lg-12" ng-show="ngCart.getTotalItems() > 0">
  <table class="table table-striped ngCart cart">
    <thead>
      <tr>
        <th></th>
        <th></th>
        <th>Quantity</th>
        <th>Amount</th>
        <th>Total</th>
      </tr>
    </thead>
    <tfoot>
      <tr ng-show="ngCart.getTax()">
        <td></td>
        <td></td>
        <td></td>
        <td>Tax ({{ ngCart.getTaxRate() }}%):</td>
        <td>{{ ngCart.getTax() | currency }}</td>
      </tr>
      <tr ng-show="ngCart.getShipping()">
        <td></td>
        <td></td>
        <td></td>
        <td>Shipping:</td>
        <td>{{ ngCart.getShipping() | currency }}</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Total:</td>
        <td>{{ ngCart.totalCost() | currency }}</td>
      </tr>
    </tfoot>
    <tbody>
      <tr ng-repeat="item in ngCart.getCart().items track by $index">
        <td><span ng-click="ngCart.removeItemById(item.getId())" class="glyphicon glyphicon-remove"></span></td>

        <td>{{ item.getName() }} <span id="#"></span></td>
        <td><!-- <span class="glyphicon glyphicon-minus" ng-class="{'disabled':item.getQuantity()==1}"
        ng-click="item.setQuantity(-1, true)"></span> -->&nbsp;&nbsp;
        {{ item.getQuantity() | number }}&nbsp;&nbsp;
        <!-- <span class="glyphicon glyphicon-plus" ng-click="item.setQuantity(1, true)"></span> --></td>
        <td>{{ item.getPrice() | currency}}</td>
        <td>{{ item.getTotal() | currency }}</td>
      </tr>
    </tbody>
  </table>
</div>
</script>

<script type="text/ng-template" id="template/ngCart/checkout.html">
<span ng-if="service=='http' || service == 'log'">
  <button class="btn btn-primary" ng-click="checkout()" ng-disabled="!ngCart.getTotalItems()" ng-transclude>Checkout</button>
</span>

</div><!--end controller-->


</script>

<script type="text/javascript">
$(document).ready(function () {
	
	//open checkout modal
	$('#myModal').on('shown.bs.modal', function () {
	  $('#myInput').focus()
	});

  //test to see if it works
	var limit = 3;
	$('input.single-checkbox').on('change', function(evt) {
	   if($(this).siblings(':checked').length >= limit) {
	       this.checked = false;
		}
	});



});//end whole script
</script>




</body>
</html>