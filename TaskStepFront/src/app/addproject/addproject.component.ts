import { Component } from '@angular/core';
import { ProjectService } from "src/service/project-service";
import { HttpClient } from '@angular/common/http';
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
    title : null,
    
  };

  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){  
    this.projectService = new ProjectService(httpClient, router);
  }

  /**
   * Communication to the api thanks to the project service
   */
  private projectService : ProjectService;


  /**
   * Add a project with the given information
   */
  submit(){
    this.projectService.addProject(this.form.title).subscribe((data) =>
      {
        if (data != null){
          this.router.navigate(["byproject"], {state : {data : { message : "Votre projet \""+ this.form.title +"\" a bien été ajouté !", type : "confirmation"}}});     
        }
        else {
          this.router.navigate(["byproject"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
        }
      }
    );
  }
}
