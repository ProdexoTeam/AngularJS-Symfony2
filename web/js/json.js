/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function membresController ($scope, $http){
     $scope.showMembres = function(){
        $http.get(Routing.generate('eleve_json_result', { id: 10 }))
            .success(function(response){  $scope.eleve = response; console.log(response); })
            .error(function(response){ alert('Une erreur est survenue'); console.log(response); });
 
    }
    $scope.showMembres();



}