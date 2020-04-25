declare global {
    interface Window{
        dataLayer:Array<dataLayerObject>;
    }
}

interface dataLayerObject{
    Category:string,
    Action:string,
    Label:string,
    event:string
}

const $ = jQuery;

export class DataLayerPush{

    protected static category:string = 'Denikates Web site';
    protected static event:string = 'auto_event';


    public static init():void{

    }




    /**
     * call function datalayer push google tag menager.
     * @param action string
     * @param label string
     * @return void
     * */
    public static callDataLayerPush(action:string , label:string):void{

        window.dataLayer.push({
            Category: this.category,
            Action: action ,
            Label: label ,
            event:this.event
        });


    }





}