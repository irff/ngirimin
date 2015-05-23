// Config (sorry hardcode)
var BASE_URL = 'http://localhost/ngirimin/public/api/';

angular.module('ngiriminApp', ['ngRoute', 'ngAnimate', 'toastr'])

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
	var LOGGED_IN = false;

	return {
		getUser: function(callback) {
			$http.get(userURL).success(callback);
		},
		register: function(user, callback) {

		},
		login: function(user, callback) {

		},
		isLoggedIn: function() {
			return LOGGED_IN;
		},
		setLoggedIn: function(value) {
			LOGGED_IN = value;
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
		},
		removeBarang: function(barang, callback) {
			$http.post(barangURL + '/' + id + '/remove').success(callback);
		},
		editBarang: function(barang, callback) {
			var id   = barang.id,
				nama = barang.nama,
				stok = barang.stok;

			$http.post(barangURL + '/' + id + '/edit', {
				'nama' : nama,
				'stok' : stok
			}).success(callback);
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
		},
		addPengiriman: function(pengiriman, callback) {
			$http.get(pengirimanURL + '/add', pengiriman).success(callback);
		},
		updateStatus: function(id, code, callback) {
			$http.get(pengirimanURL + '/' + id + '/toggle/' + code).success(callback);
		}
	};
})

.controller('mainController', function($scope, $location, NavigationService, BarangService, PengirimanService, UserService, toastr) {
	if(!UserService.isLoggedIn()) {
		$location.path('/login');
		toastr.error('Please log in first.');
	}

	$scope.navigation = NavigationService.nav;
	$scope.baseURL = NavigationService.baseURL;

	BarangService.getAllBarang(function(data) {
		console.log(data);
		$scope.allBarang = data;
	});

	PengirimanService.getAllPengiriman(function(data) {
		console.log(data);
		$scope.allPengiriman = data;
	});

})

.controller('loginController', function($scope, $location, UserService, toastr) {
	$scope.user = {
		email: '',
		password: ''
	}

	$scope.login = function() {
		console.log($scope.user);
		UserService.login($scope.user, function(response) {
			if(response.status == 'success') {
				UserService.setLoggedIn(true);
				$location.path('/home');
				toastr.success('Login berhasil.');
			} else {
				UserService.setLoggedIn(false);
				toastr.error('Login gagal. Username & password tidak cocok.');
			}
		});		
	}

	$scope.logout = function() {
		console.log('haha');
		UserService.setLoggedIn(false);
		$location.path('/login');
		toastr.success('Logout berhasil.');
	}
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

.controller('barangController', function($scope, $routeParams, $location, BarangService, UserService, toastr) {
	if(!UserService.isLoggedIn()) {
		$location.path('/login');
		toastr.error('Please log in first.');
	}

	$scope.message = 'Barang gan!';
	$scope.filterObj = {};
	var id = 1;

	$scope.barang = {
		id_user: 1,
		nama: '',
		stok: ''
	};

	$scope.editBarang = function() {
		BarangService.editBarang($scope.barang, function(data) {
			console.log(data);
			$location.path('/barang')
			toastr.success('Edit barang berhasil.');
		});
	};

	if($routeParams.barangId) {
		if($routeParams.barangId == 'add'){
			console.log('add barang');
			$scope.isAddBarang = true;

			console.log($scope.barang);

			BarangService.addBarang($scope.barangId, function(data) {
				console.log(data);
				toastr.success($scope.barang.nama + ' berhasil ditambahkan.');
			});
		}
		else{
			$scope.barangId = $routeParams.barangId;
			$scope.singleItem = true;
			console.log('single');
			$scope.isLoading2 = true;

			BarangService.getBarang($scope.barangId, function(data) {
				console.log(data);
				$scope.barang = data;
				$scope.isLoading2 = false;
			});
		}
	}
	else{
		$scope.isLoading = true;

		BarangService.getAllBarang(function(data) {
			console.log(data);
			$scope.allBarang = data;
			$scope.isLoading = false;
		});

	}

})

.controller('pengirimanController', function($scope, $location, $routeParams, PengirimanService, UserService, toastr) {
	if(!UserService.isLoggedIn()) {
		$location.path('/login');
		toastr.error('Please log in first.');
	}

	$scope.getStatus = function(statusId) {
		var namaStatus = ['Baru dipesan', 'Sudah dibayar', 'Sudah dikemas', 'Sudah dikirim', ' Sudah diterima'];
		return namaStatus[statusId];
	}

	$scope.message = 'Pengiriman gan!!';
	$scope.filterObj = {};

	var id = 1;

	$scope.pengiriman = {
		id_user: 1,
		id_barang: 1,
		jumlah_barang: 1,
		tanggal_kirim: "11 Januari 2015",
		nama: "Irfan",
		alamat: "Pocin aja",
		kodepos: "16424",
		telepon: "089666",
		email: "irfan@ui.ac.id",
		status: 0
	};

	var getAllPengiriman = function() {
		PengirimanService.getAllPengiriman(function(data) {
			console.log(data);
			$scope.allPengiriman = data;
			$scope.isLoading = false;
		});		
	}

	$scope.addPengiriman = function() {
		PengirimanService.addPengiriman($scope.pegiriman, function(data) {
			console.log(data);
			toastr.success('Pengiriman berhasil ditambahkan');
		});
	};
	$scope.updateStatus =  function(id, code) {
		PengirimanService.updateStatus(id, code, function(data) {
			console.log(data);
			getAllPengiriman();
			toastr.success('Status berhasil diubah menjadi: ' + $scope.getStatus(code));
		});
	}

	$scope.isLoading = true;
	if($routeParams.pengirimanId) {
		$scope.pengirimanId = $routeParams.pengirimanId;
		$scope.singleItem = true;
		console.log('single');

		PengirimanService.getPengiriman($scope.pengirimanId, function(data) {
			console.log(data);
			$scope.pengiriman = data;
		});
	}

	getAllPengiriman();
});