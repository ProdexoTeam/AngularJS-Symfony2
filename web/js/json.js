/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function membresController($scope, $http) {
    $scope.showMembres = function () {
        $http.get('http://localhost/AngularJS-Symfony2/web/app_dev.php/api/index')
                .success(function (response) {
                    $scope.eleve = response;
                    console.log(response);
                })
                .error(function (response) {
                    alert('Une erreur est survenue');
                    console.log(response);
                });

    }
    $scope.showMembres();
}

function AddController($scope, $http) {
    membresController($scope, $http);
    $scope.name = "za3ma"

    $scope.add = function () {
        $scope.eleve.push($scope.newEleve);
        $http.get('http://localhost/AngularJS-Symfony2/web/app_dev.php/api/add?valeur='+$scope.newEleve)
                .success(function (response) {
                    $scope.eleve = response;
                    $scope.showMembres()


                    console.log(response);

                })
                .error(function (response) {
                    alert('Une erreur est survenue');
                    console.log(response);
                });

    }

}