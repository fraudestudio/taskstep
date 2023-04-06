import { formatDate } from '@angular/common';
import { Component } from '@angular/core';

@Component({
  selector: 'app-navigation-bar',
  template: `
    <div id = "container">
    <!--Header-->
    <div id="header"> 
      <h1><img src="assets/icon.png" alt="" style="vertical-align:middle"/>&nbsp;<a href="index.php">TaskStep <span class="subtitle">1.1</span></a></h1>
    </div>
    <div id="headernav">
	    <ul>
		    <li><a><img src="assets/calendar_view_day.png" alt="" /></a><a> Aujourd'hui : {{date | date : 'dd LLLL yyyy' }}</a></li>
		    <li><a><img src="assets/house.png" alt="" /></a><a> Acceuil</a></li>
		    <li><a><img src="assets/page_white_text.png" alt="" /></a><a> Toutes les tâches</a></li>
		    <li><a><img src="assets/context.png" alt="" /></a><a> Tous les contextes</a></li>
		    <li><a><img src="assets/project.png" alt="" /></a><a> Tous les projets</a></li>
		    <li><a><img src="assets/textfield_rename.png" alt="" /></a><a> Paramètres</a></li>
		    <li><a><img src="assets/help.png" alt="" /></a><a> Aide</a></li>
		    <li><a><img src="assets/door_in.png" alt="" /></a><a> Se déconnecter</a></li>
	</ul>
</div>
  `,
  styles: [
  ]
})
export class NavigationBarComponent {
    date = Date.now();


  }
