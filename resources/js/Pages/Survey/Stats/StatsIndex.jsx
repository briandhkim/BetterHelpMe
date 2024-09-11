import SurveyLayout from '@/Layouts/SurveyLayout';
import { useEffect } from 'react';
import StatsList from './Partial/StatsList';

const StatsIndex = ({ pageTitle, survey, answers, message }) => {
	useEffect(() => {
		// console.log(answers);
	}, []);

	return (
		<SurveyLayout pageTitle={pageTitle}>
			<h2 className='mb-10 font-serif'>
				Survey:
				<span className='ml-2 font-bold'>{survey.title}</span>
			</h2>
			{Object.keys(answers).length ? (
				<>
					<StatsList answers={answers} />
				</>
			) : (
				<div>{message}</div>
			)}
		</SurveyLayout>
	);
};

export default StatsIndex;
