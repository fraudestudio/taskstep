import { formatDate } from '@angular/common';
import { Component } from '@angular/core';
import { SideBarComponent } from 'src/app/model/sideBarComponent';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { FakeDatabase } from '../model/FakeDatabase';

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
   * Get all the sidebar component
   */
  get SideBar() : SideBarComponent[]{
    return FakeDatabase.GetSideBar();
  }

  /**
   * User asked to be disconnected
  */
 disconnect(){
   sessionStorage.setItem("login","false");
   sessionStorage.setItem("token","");
   this.router.navigate(["login"]);
  }
  
  redirect(param :string) {
    this.router.navigate(["displayItemSideBar"], { queryParams: { section : param},  state : {data : {section : param}}});
  }
}

