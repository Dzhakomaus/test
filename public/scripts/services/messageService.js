(function () {

    'use strict';

    angular
        .module('authApp')
        .service('MessageService', function ($http) {
            var ms = this;
            var header = {'Content-Type': 'application/x-www-form-urlencoded'};

            ms.sendMessage = function (text) {
                return $http({
                    method: 'POST',
                    url: 'api/setMessage',
                    data: 'text=' + text,
                    headers: header
                });
            };

            ms.getMessages = function (stateParams) {
                return $http({
                    method: 'POST',
                    url: 'api/getMessages',
                    data: 'page=' + stateParams,
                    headers: header
                })
            };

            ms.filterMessages = function (filterText) {
                return $http({
                    method: 'POST',
                    url: 'api/filterMessages',
                    data: 'filterText=' + filterText,
                    headers: header
                })
            };


            ms.getUserMessage = function () {
                return $http.post('api/userMessage');
            }

        });

})();