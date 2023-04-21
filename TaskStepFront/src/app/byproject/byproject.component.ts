import { Component } from '@angular/core';
import { Project } from "src/app/model/project";
import { FakeDatabase } from '../model/FakeDatabase';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-byproject',
  templateUrl : 'byproject.component.html'
})
export class ByprojectComponent {
  constructor(private route: ActivatedRoute,  private router: Router){  
  }

  get Title() : string {
    if (this.isEditing){
      return "Choissisez un contexte à modifier ou ajouter un contexte."
    }
    else {
      return "Choissisez un contexte pour afficher les tâches qui lui sont liés. Vous pouvez aussi ajouter/éditer un contexte."
    }
  }



  private isEditing : boolean = false;

  get IsEditing() : boolean {
    return this.isEditing;
  }

  get message() : string {
    return history.state.data?.message; 
  }

  get type() : string {
    return history.state.data?.type;
  }

  goEditMode(project : Project){
    this.router.navigate(["editproject"], {state : {data : project}});
  }

  setEditMode(){
    this.isEditing = true;
  }

  get Projects() : Project[]{
    return FakeDatabase.Projects;
  }
}
