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
    this.projectDao = new ProjectService(httpClient);
  }

  private projectDao : ProjectService;


  submit(){
    this.projectDao.addProject(this.form.title).subscribe((data) =>
      {
        if (data != null){
          this.router.navigate(["byproject"], {state : {data : { message : "Votre projet \""+ this.form.title +"\" a bien été ajouter !", type : "confirmation"}}});     
        }
        else {
          this.router.navigate(["byproject"], {state : {data : { message : "Une erreur est survenue.", type : "warning"}}});
        }
      }
    );
  }
}
