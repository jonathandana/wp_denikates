/// <reference path="../../../node_modules/@types/google.analytics/index.d.ts" />
/// <reference path="../../../node_modules/@types/jquery/index.d.ts" />
/// <reference path="../../../node_modules/@types/swiper/index.d.ts" />
/// <reference path="../../../node_modules/@types/angular/index.d.ts" />



import {SimpleFunctions} from '../cls/SimpleFunctions';
import {ValidatorForms} from "../cls/ValidatorForms";
import {Accessibility} from "../cls/Accessibility";
import {DataLayerPush} from "../cls/DataLayerPush";
import {Login} from "../cls/Login";

import {AutoCompleteCtrl} from "../controllers/AutoCompleteCtrl";

import * as angular from 'angular';


const $ = jQuery;

SimpleFunctions.init();
Accessibility.init();
DataLayerPush.init();
Login.init();
SimpleFunctions.calculatePopup();

const search_form = new ValidatorForms($('.search-form form'),false);


//open search web site.
$('.open-search , .main-menu .search a').click((e)=>{
    e.preventDefault();
    SimpleFunctions.switchSearchArea();


});

$('input[type=tel]').keypress((e)=>{
    return !SimpleFunctions.onlyLetters(e);
});

//Angular Modules
angular.module('auto-complete', [])
    .constant('url_auto_complete',window.obj.auto_complete)
    .controller('AutoCompleteCtrl',['$scope','$timeout','$http','url_auto_complete',AutoCompleteCtrl])


