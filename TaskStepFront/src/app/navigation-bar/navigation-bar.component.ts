import { formatDate } from '@angular/common';
import { Component } from '@angular/core';
import { SideBarComponent } from 'src/app/model/sideBarComponent';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-navigation-bar',
  templateUrl :"navigation-bar.component.html"
})
export class NavigationBarComponent {

  private date : number = Date.now();

  constructor(private route: ActivatedRoute,  private router: Router) {
  }

  /**
   * Give the today date in french
   */
  get Date() : string{
    return formatDate(this.date,'dd LLLL yyyy', 'fr-Fr');
  }

  /**
   * Table all of the sidebar componenet of the side
   * They are requested from the server
   */
  private sideBar : SideBarComponent[] = [ 
    new SideBarComponent("lightbulb", "Idées",0,0), 
    new SideBarComponent("cart", "Vous voulez peut être acheter",0,0), 
    new SideBarComponent("lightning", "Immédiat",0,0),
    new SideBarComponent("newspaper", "Ce week-end",0,0),
    new SideBarComponent("calendar", "Ce mois-ci",0,0),
    new SideBarComponent("world", "Cette année",0,0),
    new SideBarComponent("user", "Peut-être un jour",0,0)
  ];


  /**
   * Get all the sidebar component
   */
  get SideBar() : SideBarComponent[]{
    return this.sideBar;
  }

  /**
   * User asked to be disconnected
   */
  disconnect(){
    sessionStorage.setItem("login","false");
    this.router.navigate(["login"]);
  }
  
}

