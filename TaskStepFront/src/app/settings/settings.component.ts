import { Component } from '@angular/core';
import { ThemeService } from '../theme/theme.service';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';

@Component({
  selector: 'app-settings',
  templateUrl: 'settings.component.html'
})
export class SettingsComponent {

  /**
   * Says if the button change password has been it once
   */
  private changePasswordConfirmation : boolean;

  /**
  * Says if the button purge items has been it once
  */
  private purgeItemConfirmation : boolean;

  private exportConfirmation : boolean;

  get ChangePasswordConfirmation() : boolean{
    return this.changePasswordConfirmation;
  }

  get PurgeItemConfirmation() : boolean{
    return this.purgeItemConfirmation;
  }

  get ExportConfirmation() : boolean{
    return this.exportConfirmation;
  }



  constructor(private route: ActivatedRoute,  private router: Router){
    this.changePasswordConfirmation = false;
    this.purgeItemConfirmation = false;
    this.exportConfirmation = false;
  }

  /**
   * When the change password button is clicked
   * It shows a warning the first time
   * It redirect to the changePassword page the second time
   */
  changePasswordClicked(){
    if (this.changePasswordConfirmation){
      this.router.navigate(["changePassword"]);
    }
    else {
      this.changePasswordConfirmation = true;
      this.purgeItemConfirmation = false;
      this.exportConfirmation = false;
    }
  }


  purgeItems(){
    if (this.purgeItemConfirmation){
      // A implémanter
    }
    else {
      this.purgeItemConfirmation = true;
      this.changePasswordConfirmation = false;
      this.exportConfirmation = false;
    }
  }
  exportCSV(){
    this.exportConfirmation = true;
    this.purgeItemConfirmation = false;
    this.changePasswordConfirmation = false;
  }


  get message() : string {
    return history.state.data?.message; 
  }

  get type() : string {
    return history.state.data?.type;
  } 


  /**
   * Return if the display tips is checked
   */
  get isDisplayChecked() : boolean {
    return (sessionStorage.getItem("isCheckedDisplay") == "true");
  }

  /**
   * When the display tips statue is changed
   * @param value the statue of the checkbox
   */
  onCheckedChange(value : boolean) {
    sessionStorage.setItem("isCheckedDisplay", String(value));
  }

  /**
   * Check if the theme given is the same that the actual theme
   * @param value the given theme
   * @returns boolean 
   */
  isCurrentThemeEqual(value : string){
    return value == ThemeService.getStoredTheme();
  }

  /**
   * Change the theme when it needs to change
   */
  onThemeChange(value : string){
    ThemeService.setTheme(value);
  }
}
