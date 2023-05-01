export class SideBarComponent{

  /**
   * Image of the component
   */
  private image : string;
  /**
   * Title of the component
   */
  private title : string;
  
  /**
   * Task done of the component
   */
  private done :  number;
  /**
   * Task undone of the component
   */
  private undone : number;
  
  /**
   * The name of the sidebar in database
   */
  private database : string;
  
  constructor(image : string, title : string, done : number, undone : number, database : string){
    this.image = image;
    this.title = title;
    this.done = done;
    this.undone = undone;
    this.database = database;
  }
  
  get Image() : string {
    return "assets/images/" + this.image + ".png";
  }
  
  get Title() : string {
    return " " + this.title;
  }
  
  get Done() : string {
    return "(" + this.done + ")";
  }

  set Done(value : string){
    this.done = Number(value);
  }
  
  get UnDone() : string {
    return "(" + this.undone + ")";
  }

  set UnDone(value : string){
    this.undone = Number(value);
  }

  get Database() : string {
    return this.database;
  }
}