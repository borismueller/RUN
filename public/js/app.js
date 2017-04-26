(function() {
  var app = angular.module('searchbar', []);


  app.controller('SearchController', function($scope, $http){
    $http.get("../request.php").then(function(response) {
      console.log(response);
      $scope.queries = response.data.records;
    });
  });
})();
