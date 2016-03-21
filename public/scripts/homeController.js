(function() {

    'use strict';

    angular
        .module('authApp')
        .controller('HomeController', UserController);

    function UserController($http) {

        var vm = this;

        vm.users;
        vm.error;

        vm.getUser = function() {

            $http.get('api/home').success(function(user) {
                vm.user = user;
            }).error(function(error) {
                vm.error = error;
            });
        }
    }

})();