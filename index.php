<!DOCTYPE html>
<html>
<head>
	<title>lets try</title>

	<!-- LOAD BOOTSTRAP CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">


	<!-- LOAD JQUERY -->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

	<!-- LOAD ANGULAR -->
	<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.0/angular.min.js"></script>
	<script type="text/javascript" src="ngCart.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

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
		   	$scope.customMade = response.data.customSandwhich;


		   
		   	$scope.showAction = function (id){
		   		console.log(id);
		   	}

		   	

		   	$scope.sandwhichDetails = {};

		   });

		   

			ngCart.setTaxRate(7.5);
			ngCart.setShipping(0.00);
		}]);
	</script>


	
</head>
<body ng-app="order">

<!--Display Cart Summary-->
<div ng-controller="ShopCartCtrl">
<div class="well text-center">
	<ngcart-summary></ngcart-summary>
	<button type="button" data-toggle="modal" data-target="#modaltest">Checkout</button>
</div>




<!-- SCript for Displaying total order summary -->
<script type="text/ng-template" id="template/ngCart/summary.html">
  <span class="">{{ ngCart.getTotalItems() }}
    <ng-pluralize count="ngCart.getTotalItems()" when="{1: 'item', 'other':'items'}"></ng-pluralize>
    <br />{{ ngCart.totalCost() | currency }}
  </span>
</script>


<!-- Get the Sandwhich information right-->
<div ng-controller="ShopCartCtrl">




<h2>Choose our Premade Sandwhiches</h2>
  <div class="row text-center">


    <div class="col-lg-4 col-md-4 col-xs-6  " ng-repeat="customWhich in preMade">
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
					<input type="checkbox" name="" ng-model="customWhichBread.Present"><br>
				</li>

			</ul>
			<ul ng-repeat="customWhichCategoryFinal in customWhichCategory.Meats">
				Pick a Meat:
				<li ng-repeat="customWhichMeat in customWhichCategoryFinal">
					{{customWhichMeat.Name}}
					{{customWhichMeat.Present}}
					<input type="checkbox" name="" ng-model="customWhichMeat.Present"><br>
				</li>

			</ul>
			<ul ng-repeat="customWhichCategoryFinal in customWhichCategory.Veggies">
				Pick some Veggies:
				<li ng-repeat="customWhichVeggies in customWhichCategoryFinal">
					{{customWhichVeggies.Name}}
					{{customWhichVeggies.Present}}
					<input type="checkbox" name="" ng-model="customWhichVeggies.Present"><br>
				</li>

			</ul>
			<ul ng-repeat="customWhichCategoryFinal in customWhichCategory.Condiments">
				Pick some Condiments:
				<li ng-repeat="customWhichCond in customWhichCategoryFinal">
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
      		<h3>Your Sandwhich</h3>
      		<div  ng-repeat="customWhichCategory in customWhich.Ingredients" s>

      			<span ng-repeat="customWhichCategoryFinal in customWhichCategory.Bread">
      				
      				<p ng-repeat="customWhichSingle in customWhichCategoryFinal | filter: {'Present': true}: true">
      				Bread: {{customWhichSingle.Name}}</p>
      			</span>
      			<span ng-repeat="customWhichCategoryFinal in customWhichCategory.Meats">
      				Meats:
      				<p ng-repeat="customWhichSingle in customWhichCategoryFinal | filter: {'Present': true}: true">
      				 {{customWhichSingle.Name}}</p>
      			</span>
      			<span ng-repeat="customWhichCategoryFinal in customWhichCategory.Veggies">
      				<p ng-repeat="customWhichSingle in customWhichCategoryFinal | filter: {'Present': true}: true">
      				Veggies: {{customWhichSingle.Name}}</p>
      			</span>
      			<span ng-repeat="customWhichCategoryFinal in customWhichCategory.Condiments">
      				<p ng-repeat="customWhichSingle in customWhichCategoryFinal | filter: {'Present': true}: true">
      				Condiments: {{customWhichSingle.Name}}</p>
      			</span>


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

        <td>{{ item.getName() }}</td>
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

</script>



</div>



<!-- Script for Adding Sandwhich info to cart -->
<script type="text/ng-template" id="template/ngCart/addtocart.html">
<div ng-hide="attrs.id">
  <a class="btn btn-lg btn-primary" ng-disabled="true" ng-transclude></a>
</div>
<div ng-show="attrs.id">
  <div>
    <span ng-show="quantityMax">
      <select name="quantity" id="quantity" ng-model="q" ng-options=" v for v in qtyOpt"></select>
    </span>
      <a class="btn btn-sm btn-primary " ng-click="ngCart.addItem(id, name, price, q, data)" ng-transclude  ></a>
  </div>
  <span ng-show="inCart()">
  <br>
  <p class="alert alert-info">This item is in your cart. <a ng-click="ngCart.removeItemById(id)" style="cursor: pointer;">Remove</a></p>
  </span>
</div>
</script>







<div class="modal fade" id="modaltest">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Finish Ordering</h4>
      </div>
      <div class="modal-body">
        <ngcart-cart></ngcart-cart>
      </div>
      <div class="modal-footer">
        <ngcart-checkout service="http" settings="">Checkout</ngcart-checkout>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
















<script type="text/javascript">
	$(document).ready(function () {
	$('#myModal').on('shown.bs.modal', function () {
	  $('#myInput').focus()
	});

});
</script>




</body>
</html>