import { Component } from '@angular/core';
import { FakeDatabase } from '../model/FakeDatabase';
import { Project } from "src/app/model/project";
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-editproject',
  templateUrl : 'editproject.component.html'
})



export class EditprojectComponent {
  private checkbox : boolean = true;

  private currentProject : Project = new Project("");

  /**
   * Information of the form
   */
  form : any  = {
    title : null
  };


  ngOnInit(){
    this.currentProject.Id = history.state.data.id;
    this.currentProject.Title = history.state.data.title;
    this.form.title = this.currentProject.Title;
  }

  constructor(private route: ActivatedRoute,  private router: Router){

  }

  checkBoxChanged(value : boolean){
    this.checkbox = value;
  }


  deleteProject(){
    FakeDatabase.RemoveProject(this.currentProject.Id);
    this.router.navigate(["byproject"], {state : {data : {message : "Votre projet \""+ this.form.title +"\" a bien été supprimer !", type : "confirmation"}}});    
  }

  submit(){

    FakeDatabase.ModifyProject(this.currentProject.Id,new Project(this.form.title));
    this.router.navigate(["byproject"], {state : {data : {message : "Votre projet \""+ this.form.title +"\" a bien été modifier !", type : "confirmation"}}});
  }
  
}
