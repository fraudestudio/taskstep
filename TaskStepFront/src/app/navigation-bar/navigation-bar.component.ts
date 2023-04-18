import { formatDate } from '@angular/common';
import { Component } from '@angular/core';

@Component({
  selector: 'app-navigation-bar',
  templateUrl :"navigation-bar.html"
})
export class NavigationBarComponent {
  private date : number = Date.now();

  get Date() : string{
    return formatDate(this.date,'dd LLLL yyyy', 'fr-Fr');
  }

  private sideBar : SideBarComponent[] = [ 
    new SideBarComponent("lightbulb", "Idées",0,0), 
    new SideBarComponent("cart", "Vous voulez peut être acheter",0,0), 
    new SideBarComponent("lightning", "Immédiat",0,0),
    new SideBarComponent("newspaper", "Ce week-end",0,0),
    new SideBarComponent("calendar", "Ce mois-ci",0,0),
    new SideBarComponent("world", "Cette année",0,0),
    new SideBarComponent("user", "Peut-être un jour",0,0)
  ];

  get SideBar() : SideBarComponent[]{
    return this.sideBar;

  }
  
}

class SideBarComponent{

  private image : string;
  private title : string;

  private done :  number;
  private undone : number;



  constructor(image : string, title : string, done : number, undone : number){
    this.image = image;
    this.title = title;
    this.done = done;
    this.undone = undone;
  }

  get Image() : string {
    return "assets/" + this.image + ".png";
  }

  get Title() : string {
    return " " + this.title;
  }

  get Done() : string {
    return "(" + this.done + ")";
  }

  get UnDone() : string {
    return "(" + this.undone + ")";
  }
}