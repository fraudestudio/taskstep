import { Component, OnInit } from '@angular/core';
import { Project } from "src/app/model/project";
import { ProjectDao } from "src/app/model/project-service";
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Component({
  selector: 'app-byproject',
  templateUrl : 'byproject.component.html'
})
export class ByprojectComponent implements OnInit {
  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){  
    this.projectDao = new ProjectDao(httpClient);
  }

  private projectDao : ProjectDao;

  private projects : Project[] = []

  ngOnInit(){
    this.projectDao.getProjects().subscribe(projects => this.projects = projects);
  }

  get Title() : string {
    if (this.isEditing){
      return "Choissisez un projet à modifier ou ajouter un projet."
    }
    else {
      return "Choissisez un projet pour afficher les tâches qui lui sont liés. Vous pouvez aussi ajouter/éditer un projet."
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

  goEditMode(id : number){
    this.router.navigate(["editproject"], {state : {data : id}});
  }

  setEditMode(){
    this.isEditing = true;
  }

  get Projects() : any{
    return this.projects;
  }
}
