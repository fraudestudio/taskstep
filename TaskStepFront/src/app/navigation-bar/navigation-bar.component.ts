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
   * Get the date withour letter
   */
  get RawDate() : string{
    return formatDate(this.date, 'dd-MM-yyyy','fr-Fr');
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
  
  /**
   * Redirect to a display of items by section
   * @param title 
   * @param section 
   */
  redirectSection(title : string, section : string) {
    this.router.routeReuseStrategy.shouldReuseRoute = () => false;
    this.router.onSameUrlNavigation = 'reload';
    this.router.navigate(["displayItemSideBar"], { state : {data : { title : title, section : section }}});
  }

  /**
   * Redirect to a display of items by date
   * @param date 
   */
  redirectDate(date : string){
      this.router.routeReuseStrategy.shouldReuseRoute = () => false;
      this.router.onSameUrlNavigation = 'reload';
      console.log(date);
      this.router.navigate(["displayItemSideBar"], { state : {data : { title : "Tâches d'aujourd'hui", date : date }}});
  }

  /**
   * Redirect to a display of all the items
   */
  redirect(){
    this.router.routeReuseStrategy.shouldReuseRoute = () => false;
    this.router.onSameUrlNavigation = 'reload';
    this.router.navigate(["displayItemSideBar"], { state : {data : { title : "Toutes les tâches" }}});
  }
}

