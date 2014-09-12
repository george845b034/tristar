// define angular module/app
var formApp = angular.module('formApp', []);

// create angular controller and pass in $scope and $http
function contactUsController($scope, $http) {
  $scope.formData = {};
  $scope.formData.type = 1;
  // process the form
  $scope.processForm = function(myForm) {
    // console.log($scope.formData);
    if(myForm.$valid)
    {
      $http({
          method  : 'POST',
          url     : '',
          data    : $.param($scope.formData),  // pass in data as strings
          headers : { 'Content-Type': 'application/x-www-form-urlencoded' },  // set the headers so angular passing info as form data (not request payload)
          responseType     : 'json'
      }).success(function(data) {
          if (!data.status) {
            // if not successful, bind errors to error variables
              $scope.errorMessage = data.errorMessage;
          } else {
            // if successful, bind success message to message
              $scope.message = data.message;
          }
          $scope.messageForm.$setPristine();
          $scope.formData = {};
          $scope.formData.type = 1;
      });
    }
  };
}