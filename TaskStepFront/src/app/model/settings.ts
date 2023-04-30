export class Settings {
    /**
     * Style of the user settings
     */
    public Style : string;
    /**
     * Tips of the user settings
     */
    public Tips : boolean;

    constructor(Style : string, Tips : boolean){
        this.Style = Style;
        this.Tips = Tips;
    }
}