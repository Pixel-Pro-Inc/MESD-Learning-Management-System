import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PsdlInformation8Component } from './psdl-information-8.component';

describe('PsdlInformation8Component', () => {
  let component: PsdlInformation8Component;
  let fixture: ComponentFixture<PsdlInformation8Component>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [PsdlInformation8Component],
    }).compileComponents();

    fixture = TestBed.createComponent(PsdlInformation8Component);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
