angular.module('ngiriminApp', ['ngRoute'])

.config(function($routeProvider, $locationProvider) {
	$routeProvider.when('/', {
		templateUrl: 'templates/home.html',
		controller: 'mainController'
	})

	.when('/home', {
		templateUrl: 'templates/home.html',
		controller: 'mainController'
	})

	.when('/login', {
		templateUrl: 'templates/login.html',
		controller: 'loginController'
	})

	.when('/register', {
		templateUrl: 'templates/register.html',
		controller: 'registerController'
	})

	.when('/barang', {
		templateUrl: 'templates/barang.html',
		controller: 'barangController'
	});

	$locationProvider.html5Mode(true);
})

.factory('NavigationService', function() {
	var nav = [
		{
			url: 'home',
			name: 'Home',
			icon: 'mdi-editor-insert-chart'
		},
		{
			url: 'barang',
			name: 'Daftar Barang',
			icon: 'mdi-action-shopping-cart'
		},
		{
			url: 'pengiriman',
			name: 'Daftar Pengiriman',
			icon: 'mdi-maps-local-shipping'
		}

	];

	return {
		nav: nav,
		baseURL: '/ngirimin-front'
	};
})

.controller('mainController', function($scope, NavigationService) {
	$scope.message = 'HOME GAN!';

	$scope.navigation = NavigationService.nav;
	$scope.baseURL = NavigationService.baseURL;
})

.controller('loginController', function($scope) {
	$scope.message = 'Login gan!!';
})

.controller('registerController', function($scope) {
	$scope.message = 'Register gan!!';
})

.controller('barangController', function($scope) {
	$scope.message = 'Barang gan!';
});
