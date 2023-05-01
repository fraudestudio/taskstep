import { Component, OnInit } from '@angular/core';
import { Project } from "src/app/model/project";
import { ProjectService } from "src/service/project-service";
import { HttpClient } from '@angular/common/http';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';


@Component({
  selector: 'app-byproject',
  templateUrl : 'byproject.component.html'
})
export class ByprojectComponent implements OnInit {
  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){  
    this.projectService = new ProjectService(httpClient, router);
  }


  /**
   * Communication to the api thanks to the project service
   */
  private projectService : ProjectService;

  /**
   * The projects to display
   */
  private projects : Project[] = []

  get Projects() : any{
    return this.projects;
  }

  /**
   * Init data
   */
  ngOnInit(){
    this.projectService.getProjects().subscribe(projects => this.projects = projects);
  }


  /**
   * Get the title of the page to display
   */
  get Title() : string {
    if (this.isEditing){
      return "Choisissez un projet à modifier ou ajouter un projet."
    }
    else {
      return "Choisissez un projet pour afficher les tâches qui lui sont liées. Vous pouvez aussi ajouter/éditer un projet."
    }
  }


  /**
   * Tells if the page is in edit mode or not
   */
  private isEditing : boolean = false;

  get IsEditing() : boolean {
    return this.isEditing;
  }

  /***
   * Message to display if there is any
   */
  get message() : string {
    return history.state.data?.message; 
  }

  /**
   * Type of the message to display if there is any
   */
  get type() : string {
    return history.state.data?.type;
  }

  /**
   * Go to the item section of the project
   * @param id the id of the project
   * @param title the title of the project
   */
  goItem(id : number, title : string){
    this.router.navigate(["displayItemSideBar"], { state : {data : { title : title, project : id }}});
  }

  /**
   * Go to the edit page with the current project
   * @param id id of the project
   */
  goEditMode(id : number){
    this.router.navigate(["editproject"], {state : {data : id}});
  }

  /**
   * Set the page in edit mode
   */
  setEditMode(){
    this.isEditing = true;
  }
}
