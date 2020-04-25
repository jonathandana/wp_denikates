import * as angular from 'angular';
import {SimpleFunctions} from "../cls/SimpleFunctions";
export class AutoCompleteCtrl{
    private last_value = '';
    private timeout;

    constructor(private readonly $scope, private readonly $timeout, private readonly $http, private readonly url_auto_complete){
        this.initScope();
    }

    private initScope(){
        this.$scope.results = [];
        this.$scope.searchHandle = ($event)=> this.searchHandle($event);
        this.$scope.resultsMove  = ($event)=> this.resultsMove($event);
    }

    private searchHandle($event){
        SimpleFunctions.detectIsMobile();
        this.resultsMove($event);
        let ppp = SimpleFunctions.isMobile ? 5 : 10;

        if(typeof this.$scope.searchValue == 'undefined' || this.$scope.searchValue.length < 2 || this.last_value == this.$scope.searchValue){
           return false
        }

        if(this.timeout){
            this.$timeout.cancel(this.timeout);
        }

        this.last_value = this.$scope.searchValue;

        this.timeout = this.$timeout(()=>{
         this.$http.get(this.url_auto_complete+'?q='+this.$scope.searchValue+'&ppp='+ppp)
           .then((results)=>{
               this.$scope.results = results.data;
            });
        },300);

    }

    private resultsMove(e){
        const keyCode = e.keyCode;
        if(keyCode != 40 && keyCode != 38){
            return;
        }

        e.preventDefault();
        let elements = angular.element('.wrap-auto-complete li.selected');
        if(!elements.length){
            elements = angular.element('.wrap-auto-complete li:first-child').addClass('selected');
            elements.find('a').focus();
            return;
        }

        e.preventDefault();
        if(keyCode == 40){
            elements.removeClass('selected').next().addClass('selected').find('a').focus();
        }else if(keyCode == 38){
            elements.removeClass('selected').prev().addClass('selected').find('a').focus();
        }
        return false;
    }

}