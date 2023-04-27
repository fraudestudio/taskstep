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

  
  private checkbox : boolean = true;


  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){  
    this.projectDao = new ProjectService(httpClient);
  }

  private projectDao : ProjectService;

  private currentProject : Project = new Project("");

  get CurrentProject() : Project {
    return this.currentProject;
  }

  hasReceivedInfo() : boolean{
    return this.currentProject.Id != -1;
  }


  /**
   * Information of the form
   */
  form : any  = {
    title : null
  };


  ngOnInit() : void{
    this.projectDao.getProject(history.state.data).subscribe(project => this.form.title = project.Title);
    this.projectDao.getProject(history.state.data).subscribe(project => this.currentProject = project);
  }

  deleteProject(){
    this.projectDao.deleteProject(history.state.data).subscribe((data) =>
    {
      if (!data){
        this.router.navigate(["byproject"], {state : {data : {message : "Votre projet \""+ this.form.title +"\" a bien été supprimer !", type : "confirmation"}}});       
      }
      else {
        this.router.navigate(["byproject"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
      }
    });  
  }

  submit(){
    this.projectDao.modifyProject(history.state.data, this.form.title).subscribe((data) =>
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
