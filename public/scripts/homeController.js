(function () {

    'use strict';

    angular
        .module('authApp')
        .controller('HomeController', UserController);

    function UserController($stateParams, $auth, $state, $http) {
        var vm = this;

        $http({
            method: 'POST',
            url: 'api/getMes',
            data: 'page=' + $stateParams['id'],
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).success(function (response) {
            console.log(response);
            vm.mess = response;
        }).error(function (error) {
            vm.error = error;
        });

        vm.sendMes = function () {

            $http({
                method: 'POST',
                url: 'api/setmes',
                data: 'text=' + vm.text,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).success(function (response) {
                vm.mess = response;
            }).error(function (error) {
                console.log(error);
                vm.error = error;
            });
        };

        vm.getNumber = function (num) {
            return new Array(num);
        }

    }

})();