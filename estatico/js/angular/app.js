var app = angular.module('app', ["angucomplete"]);

app.controller('MainController', ['$scope', '$http',
    function MainController($scope, $http) {

        $scope.usuarios = [
            {firstName: "Daryl", surname: "Rowland", twitter: "@darylrowland", pic: "img/daryl.jpeg"},
            {firstName: "Alan", surname: "Partridge", twitter: "@alangpartridge", pic: "img/alanp.jpg"},
            {firstName: "Annie", surname: "Rowland", twitter: "@anklesannie", pic: "img/annie.jpg"}
        ];

    }
]);


