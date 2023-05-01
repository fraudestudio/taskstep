import { Component } from '@angular/core';
import { ThemeService } from '../theme/theme.service';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import { ItemService } from 'src/service/item-service';
import { AuthService } from 'src/service/auth-service';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-settings',
  templateUrl: 'settings.component.html'
})
export class SettingsComponent {


  private numberPurged = 0;

  /**
   * Says if the button change password has been it once
   */
  private changePasswordConfirmation : boolean;

  /**
  * Says if the button purge items has been it once
  */
  private purgeItemConfirmation : boolean;

  /**
   * Says if the csv is being sent
   */
  private exportConfirmation : boolean;

  private itemPurged : boolean = false;

  /**
   * Communication to api with the auth service
   */
  private authService : AuthService;

  private itemService : ItemService;

  get ChangePasswordConfirmation() : boolean{
    return this.changePasswordConfirmation;
  }

  get PurgeItemConfirmation() : boolean{
    return this.purgeItemConfirmation;
  }

  get ExportConfirmation() : boolean{
    return this.exportConfirmation;
  }

  get ItemPurged() : boolean {
    return this.itemPurged;
  }

  get NumberPurged() : number{
    return this.numberPurged;
  }


  constructor(private route: ActivatedRoute,  private router: Router, private httpClient : HttpClient){
    this.authService = new AuthService(httpClient);
    this.itemService = new ItemService(httpClient,router);
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
      this.itemPurged = false;
    }
  }

  /**
   * Delete all the items that are done if the user confirmed it
   */
  purgeItems(){
    if (this.purgeItemConfirmation){
      this.itemService.deleteDoneItem().subscribe((data) => {
        this.numberPurged = data;
        this.itemPurged = true;
        this.purgeItemConfirmation = false;
      })
    }
    else {
      this.purgeItemConfirmation = true;
      this.changePasswordConfirmation = false;
      this.exportConfirmation = false;
      this.itemPurged = false;
    }
  }

  /**
   * Redirect to a csv download page
   */
  exportCSV(){
    this.exportConfirmation = true;
    this.purgeItemConfirmation = false;
    this.changePasswordConfirmation = false;
    this.itemPurged = false;
  }

  /**
   * Message to display if there is one
   */
  get message() : string {
    return history.state.data?.message; 
  }

  /**
   * Type of the messsage if there is one
   */
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
    this.authService.updateSettings(ThemeService.getStoredTheme(),value).subscribe();
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
    this.authService.updateSettings(ThemeService.getStoredTheme(),this.isDisplayChecked).subscribe();
  }
}
