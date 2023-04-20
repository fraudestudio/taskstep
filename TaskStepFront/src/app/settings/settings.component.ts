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

  get ChangePasswordConfirmation() : boolean{
    return this.changePasswordConfirmation;
  }

  constructor(private route: ActivatedRoute,  private router: Router){
    this.changePasswordConfirmation = false;
  }

  changePasswordClicked(){
    if (this.changePasswordConfirmation){
      this.router.navigate(["changePassword"]);
    }
    else {
      this.changePasswordConfirmation = true;
    }
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
