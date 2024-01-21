import { Component, OnInit, ViewChild } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { ToastrService } from 'ngx-toastr';
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
    private toastService: ToastrService,
    private preferencesService: PreferencesService,
    private routerService: Router
  ) {}

  serviceForm: FormGroup;
  plantInformationData = {
    columns: [
      {
        field: 'lineItem',

        headerText: 'Equipment',

        textAlign: 'Left',
      },
      {
        field: 'number',

        headerText: 'Number / sqm',

        textAlign: 'Right',
      },
      {
        field: 'value',

        headerText: 'Value (BWP)',

        textAlign: 'Right',
      },
    ],
    data: [
      { lineItem: 'Tumbling Machines', number: 0, value: 0 },
      { lineItem: 'Cutting Machines', number: 0, value: 0 },
      { lineItem: 'Buildings', number: '', value: 0 },
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
        this.plantInformationData.data =
          prefs.certFormsPersistence.psdl3.plantInformation;
      }
    }
    this.dataGrid.setTableValues(this.plantInformationData);
  }

  delay(ms: number) {
    return new Promise((resolve) => setTimeout(resolve, ms));
  }

  initializeForm() {
    this.serviceForm = this.fb.group({
      plantInformation: [''],
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

    this.serviceForm.controls.plantInformation.setValue(csv);

    let prefs = this.preferencesService.getPreferences();

    if (prefs.certFormsPersistence == null) {
      prefs.certFormsPersistence = {};
    }

    prefs.certFormsPersistence.psdl3 = this.serviceForm.value;

    this.preferencesService.setPreferences(prefs);

    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-4'
    );
  }

  previous() {
    this.routerService.navigateByUrl(
      '/portal/certificates-licenses/psdl-information-2'
    );
  }
}
