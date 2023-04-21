import { Component } from '@angular/core';
import { FakeDatabase } from '../model/FakeDatabase';
import { Project } from "src/app/model/project";
import { Router, ActivatedRoute, ParamMap } from '@angular/router';


@Component({
  selector: 'app-addproject',
  templateUrl : 'addproject.component.html'
})
export class AddprojectComponent {
  /**
   * Information of the form
   */
  form : any  = {
    title : null
  };

  constructor(private route: ActivatedRoute,  private router: Router){
    
  }


  submit(){
    FakeDatabase.AddProject(new Project(this.form.title));
    this.router.navigate(["byproject"], {state : {data : { message : "Votre projet \""+ this.form.title +"\" a bien été ajouter !", type : "confirmation"}}});
  }
}
