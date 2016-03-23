(function () {

    'use strict';

    angular
        .module('authApp')
        .controller('ProfileController', ProfileController);


    function ProfileController($auth, $state, $http) {

        var vm = this;

        vm.myMessage = function () {
            $http.post('api/myMessages').success(function (response) {
                console.log(response);
                vm.mess = response;
            }).error(function (error) {
                vm.error = error;
            });
        };

        vm.logout = function () {
            $auth.logout(function () {
                $state.go('auth', {});
            });
        };

        vm.myMessage();
    }

})();