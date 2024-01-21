import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { Router } from '@angular/router';
import { DataGridInputComponent } from 'src/app/customer-portal/ui/data-grid-input/data-grid-input.component';
import { PreferencesService } from 'src/app/shared/services/preferences-service/preferences.service';

@Component({
  selector: 'app-psdl-information-3',
  templateUrl: './psdl-information-3.component.html',
  styleUrls: ['./psdl-information-3.component.css'],
})
export class PsdlInformation3Component implements OnInit {
  @ViewChild('dataGridCmp') dataGrid: DataGridInputComponent;
  constructor(
    private fb: FormBuilder,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  serviceForm: FormGroup;
  employmentInformationData = {
    columns: [
      {
        field: 'lineItem',

        headerText: 'Personnel',

        textAlign: 'Left',
      },
      {
        field: 'number',

        headerText: 'Number',

        textAlign: 'Right',
      },
      {
        field: 'value',

        headerText: 'Salaries/Wages (BWP)',

        textAlign: 'Right',
      },
    ],
    data: [
      { lineItem: 'Cutters', number: 0, value: 0 },
      { lineItem: 'Polishers', number: 0, value: 0 },
      { lineItem: 'Sawyers', number: 0, value: 0 },
      { lineItem: 'Cleavers', number: 0, value: 0 },
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
      if (prefs.certFormsPersistence.psdl3 != null) {
        this.employmentInformationData.data =
          prefs.certFormsPersistence.psdl3.employmentInformation;
      }
    }
    this.dataGrid.setTableValues(this.employmentInformationData);
  }

  delay(ms: number) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      employmentInformation: [''],
    });

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence != null) {
      if (prefs.certFormsPersistence.psdl3 != null) {
        this.serviceForm.setValue(prefs.certFormsPersistence.psdl3);
      }
    }
  }

  next() {
    //Store form data
    //Save CSV
    let csv = this.dataGrid.getDataSource();

    this.serviceForm.controls.employmentInformation.setValue(csv);

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl3 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/dcl-information-4'
    );
  }

  previous() {
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/dcl-information-2'
    );
  }
}
