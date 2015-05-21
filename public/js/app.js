// Config (sorry hardcode)
var BASE_URL = 'http://localhost/ngirimin/public/api/';
var LOGGED_IN = false;

angular.module('ngiriminApp', ['ngRoute'])

.config(function($routeProvider, $locationProvider) {
	$routeProvider.when('/', {
		redirectTo: '/home'
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

	.when('/user', {
		templateUrl: 'templates/user.html',
		controller: 'userController'
	})

	.when('/barang', {
		templateUrl: 'templates/barang.html',
		controller: 'barangController'
	})

	.when('/barang/:barangId', {
		templateUrl: 'templates/barang.html',
		controller: 'barangController'
	})

	.when('/pengiriman', {
		templateUrl: 'templates/pengiriman.html',
		controller: 'pengirimanController'
	})

	.when('/pengiriman/:pengirimanId', {
		templateUrl: 'templates/pengiriman.html',
		controller: 'pengirimanController'
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

.factory('UserService', function($http) {
	var userURL = BASE_URL + 'user';
	return {
		getUser: function(callback) {
			$http.get(userURL).success(callback);
		}
	};
})

.factory('BarangService', function($http) {
	var barangURL = BASE_URL + 'barang';
	return {
		getAllBarang: function(callback) {
			$http.get(barangURL).success(callback);
		},
		getBarang: function(id, callback) {
			$http.get(barangURL + '/' + id).success(callback);
		},
		addBarang: function(barang, callback) {
			$http.post(barangURL + '/add', barang).success(callback);
		}
	};
})

.factory('PengirimanService', function($http) {
	var pengirimanURL = BASE_URL + 'pengiriman';

	return {
		getAllPengiriman: function(callback) {
			$http.get(pengirimanURL).success(callback);
		},
		getPengiriman: function(id, callback) {
			$http.get(pengirimanURL + '/' + id).success(callback);
		}
	}
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

.controller('userController', function($scope, UserService) {
	$scope.message = 'User gan!!';
	UserService.getUser(function(data) {
		$scope.user = data;
	})
})

.controller('barangController', function($scope, $routeParams, BarangService) {
	$scope.message = 'Barang gan!';
	var id = 1;

	$scope.barang = {
		id_user: 1,
		nama: 'Pepsodent 1kg',
		stok: 100
	};

	$scope.addBarang = function() {
		BarangService.addBarang($scope.barang, function(data) {
			console.log(data);
		});
	};

	BarangService.getAllBarang(function(data) {
		console.log(data);
		$scope.allBarang = data;
	});

	if($routeParams.barangId) {
		$scope.barangId = $routeParams.barangId;
		$scope.singleItem = true;
		console.log('single');

		BarangService.getBarang($scope.barangId, function(data) {
			console.log(data);
			$scope.barang = data;
		});
	}

})

.controller('pengirimanController', function($scope, $routeParams, PengirimanService) {
	$scope.message = 'Pengiriman gan!!';
	var id = 1;

	PengirimanService.getAllPengiriman(function(data) {
		console.log(data);
		$scope.allPengiriman = data;
	});

	if($routeParams.pengirimanId) {
		$scope.pengirimanId = $routeParams.pengirimanId;
		$scope.singleItem = true;
		console.log('single');

		PengirimanService.getPengiriman($scope.pengirimanId, function(data) {
			console.log(data);
			$scope.pengiriman = data;
		});
	}
});