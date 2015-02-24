var tagsService = angular.module('tagsService', []);
var postsApp = angular.module('postsApp', ['ui.codemirror', 'ui.select', 'tagsService']);

postsApp.controller('EditorController', ['$scope', '$window', function($scope, $window) {
    //codemirror editor settings
    $scope.editorOptions = {
        lineWrapping : true,
        indentUnit : 4,
    };

    //get word count of text
    $scope.countOf = function(text) {
        if(!text) {
            return 0;
        }
        // search for matches and count them
        else {
            var matches = text.match(/[^\s\n\r]+/g);
            return matches ? matches.length : 0;
        }
    };
}]);

tagsService.factory('Tags', ['$http', function($http) {
    return {
        // get all the comments
        get : function() {
            return $http.get('/api/tags');
        }
    }
}]);

postsApp.controller('FooterController', ['$scope', '$http', 'Tags', function($scope, $http, Tags) {
    //set defaults for publish status
    $scope.init = function(text, status) {
        $scope.submitText = text;
        $scope.submitStatus = status;
        Tags.get().success(function(data) {
            $scope.allTags = data;
        });
    }
    //toggle the publish status value
    $scope.updateSubmit = function(value) {
        $scope.submitText = value;
    };


}]);

//commonmark directive
postsApp.directive('commonmark', function () {
    var writer = new commonmark.HtmlRenderer();
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var htmlText = writer.render(element.text());
            element.html(htmlText);
        }
    };
});

//commonmark filter
postsApp.filter('commonmark', function ($sce) {
    var reader = new commonmark.Parser();
    var writer = new commonmark.HtmlRenderer();
    return function (value) {
        var html = writer.render(reader.parse(value || ''));
        return $sce.trustAsHtml(html);
    };
});
