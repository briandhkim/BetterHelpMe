import SurveyLayout from '@/Layouts/SurveyLayout';
import React from 'react';

const AnswerReceived = ({ pageTitle, survey }) => {
	return (
		<SurveyLayout pageTitle={pageTitle}>
			<div className='min-h-96'>
				<h2 className='text-xl font-extrabold font-mono'>
					Your response for "{survey.title}" has been received.
				</h2>
			</div>
		</SurveyLayout>
	);
};

export default AnswerReceived;
