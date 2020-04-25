<div class="search-form" ng-app="auto-complete" ng-controller="AutoCompleteCtrl">
    <form class="clear-fixed" method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <div class="wrap-field search">
            <input type="text"
                   aria-required="true"
                   autocomplete="off"
                   data-jd-require="true" data-jd-message-error="שדה חובה" data-jd-vtype="simpleValid"
                   class="form-input" id="form_search" placeholder="חפש"
                   aria-label="חפש" value="<?= get_search_query();?>"
                   name="s" maxlength="80"
                   ng-model="searchValue" ng-keyup="searchHandle($event, searchValue)"/>

            <!-- auto complete search-->
            <div class="wrap-auto-complete" ng-show="searchValue.length >= 2" ng-if="results.length > 1">
                <ul>
                    <li ng-keydown="resultsMove($event);" ng-repeat="result in results">
                        <a ng-href="{{result.url}}">
                            <img alt="" ng-src="{{result.img}}"/>
                            <div class="name-product">{{result.name}}</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="wrap-field submit">
            <input type="submit" id="form_submit" value="חפש" aria-label="חפש">
        </div>
    </form>
</div>