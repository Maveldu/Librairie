/**
 * Created by gvent on 08/02/2017.
 */
//On crée le module NoteApp :
var nApp = angular.module("NoteApp",['ngCookies']) ;

nApp.controller('NoteController', ['$scope','$cookies', function($scope,$cookies) {
    $scope.messageNote;
    $scope.counter = 0 ;

    //Fonction pour regrouper les comportements souhaités
    $scope.analyse = function(){
        $scope.count();
        $scope.showStatus();

    }

    $scope.save = function(){
        if($scope.messageNote!==''){
            $cookies.put('message',$scope.messageNote);
            $scope.status = 1;
            $('#status').removeClass().addClass("alert-success");
        }
    }
    $scope.clear = function(){
        $scope.messageNote= "";
        $scope.status = 2;
        $scope.analyse();
    }

    $scope.count = function(){
        $scope.counter = $scope.messageNote.length;
        $scope.status = 0;
    }
    //test
}]);