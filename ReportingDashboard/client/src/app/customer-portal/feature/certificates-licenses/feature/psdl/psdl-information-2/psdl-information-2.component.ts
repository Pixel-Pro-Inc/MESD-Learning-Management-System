import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
import { DataGridInputComponent } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.component';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-2',
  templateUrl: './psdl-information-2.component.html',
  styleUrls: ['./psdl-information-2.component.css'],
})
export class PsdlInformation2Component implements OnInit {
  @ViewChild('dataGridCmp') dataGrid: DataGridInputComponent;
  constructor(
    private fb: FormBuilder,
    private toastService: ToastrService,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  serviceForm: FormGroup;

  shareholderData = {
    columns: [
      {
        field: 'names',

        headerText: 'Full Names of Share Holders',

        textAlign: 'Left',
      },
      {
        field: 'nationalities',

        headerText: 'Share Holders Nationalities',

        textAlign: 'Left',
      },
    ],
    data: [
      { names: 'Name', nationalities: 'Nationality' },
      { names: 'Name', nationalities: 'Nationality' },
    ],
  };

  ngOnInit(): void {
    this.initializeForm();
  }

  ngAfterViewInit(): void {
    this.initExcel();
  }

  async initExcel() {
    await this.delay(100);
    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl2 != null) {
        this.shareholderData.data =
          prefs.certFormsPersistence.psdl2.shareholdersDetails;
      }
    }
    this.dataGrid.setTableValues(this.shareholderData);
  }

  delay(ms: number) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      shareholdersDetails: [''],
      intendedOperations: ['', Validators.required],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl2 != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.psdl2);
      }
    }
  }

  next() {
    //Store form data
    //Save CSV
    let csv = this.dataGrid.getDataSource();

    this.serviceForm.controls.shareholdersDetails.setValue(csv);

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl2 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-3'
    );
  }

  previous() {
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-1'
    );
  }
}
