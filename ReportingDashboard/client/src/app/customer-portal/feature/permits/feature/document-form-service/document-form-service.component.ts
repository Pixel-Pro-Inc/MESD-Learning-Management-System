import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';
import { PermitsComponent } from '../permits/permits.component';

@Component({
  selector: 'app-document-form-service',
  templateUrl: './document-form-service.component.html',
  styleUrls: ['./document-form-service.component.css'],
})
export class DocumentFormServiceComponent implements OnInit {
  constructor(
    private fb: FormBuilder,
    private routerService: Router,
    private preferencesService: PreferencesService
  ) {}

  parent: PermitsComponent;
  serviceForm: FormGroup;

  ngOnInit(): void {
    this.initializeForm();
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      service: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.permitFormsPersistence != null) {
      if (prefs.permitFormsPersistence.service != null) {
        this.serviceForm.setValue(prefs.permitFormsPersistence.service);
      }
    }
  }

  selectService() {
    //Store form data

    //Set forms to use
    if (
      this.serviceForm.controls.service.value == 'Rough Diamond Export Permit'
    ) {
      this.parent.items = this.parent.itemsRDEP;

      this.routerService.navigateByUrl('/portal/permits/rdep-information-1');
    }

    let prefs = this.preferencesService.getPreferences();

    if (prefs.currentPermitFormSelected != null && this.parent.items != null) {
      if (
        prefs.currentPermitFormSelected[1].routerLink !=
        this.parent.items[1].routerLink
      ) {
        prefs.permitFormsPersistence = {};
      }
    }

    if (prefs.permitFormsPersistence == null) {
      prefs.permitFormsPersistence = {};
    }

    prefs.currentPermitFormSelected = this.parent.items;

    prefs.permitFormsPersistence.service = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);
  }
}
