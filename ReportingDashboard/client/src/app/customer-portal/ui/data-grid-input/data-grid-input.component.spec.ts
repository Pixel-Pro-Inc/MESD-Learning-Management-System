import { ComponentFixture, TestBed } from '@angular/core/testing';

import { DataGridInputComponent } from './data-grid-input.component';

describe('DataGridInputComponent', () => {
  let component: DataGridInputComponent;
  let fixture: ComponentFixture<DataGridInputComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ DataGridInputComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(DataGridInputComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
