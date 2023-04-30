import { Component, OnInit } from '@angular/core';
import { ProjectService } from "src/service/project-service";
import { HttpClient } from '@angular/common/http';
import { Project } from "src/app/model/project";
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-editproject',
  templateUrl : 'editproject.component.html'
})



export class EditprojectComponent implements OnInit {

  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){  
    this.projectService = new ProjectService(httpClient, router);
  }

  /**
   * The communication with the api thanks to the project service
   */
  private projectService : ProjectService;

  /**
   * The current project to edit
   */
  private currentProject : Project = new Project("",-1);

  get CurrentProject() : Project {
    return this.currentProject;
  }

  /**
   * Check if the info has been sent
   * @returns the result of the verification
   */
  hasReceivedInfo() : boolean{
    return this.currentProject.Id != -1;
  }


  /**
   * Information of the form
   */
  form : any  = {
    title : null
  };

  /**
   * Init the projects
   */
  ngOnInit() : void{
    this.projectService.getProject(history.state.data).subscribe((project) =>{
      this.form.title = project.Title;
      this.currentProject = project;
    });
  }

  /**
   * Delete the current project 
   */
  deleteProject(){
    this.projectService.deleteProject(history.state.data).subscribe((data) =>
    {
      if (!data){
        this.router.navigate(["byproject"], {state : {data : {message : "Votre projet \""+ this.form.title +"\" a bien été supprimer !", type : "confirmation"}}});       
      }
      else {
        this.router.navigate(["byproject"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
      }
    });  
  }

  /**
   * Submit the modification of the current project
   */
  submit(){
    this.projectService.modifyProject(history.state.data, this.form.title).subscribe((data) =>
    {
      if (!data){
        this.router.navigate(["byproject"], {state : {data : {message : "Votre projet \""+ this.form.title +"\" a bien été modifier !", type : "confirmation"}}});       
      }
      else {
        this.router.navigate(["byproject"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
      }
    });  
  }
}
